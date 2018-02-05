<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JobController
 *
 * @package App\Controller
 *
 * @Route("job")
 */
class JobController extends Controller
{
  /**
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
   * @Route("/", name="job_index")
   */
  public function index(Request $request)
  {
    $id = null;
    $errors = [];

    $em = $this->getDoctrine()->getManager();

    /**
     * Job's receiving
     */
    $job = new Job();
    $form = $this->createForm(JobType::class, $job);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $receivedData = $job->getReceivedData();

      /**
       * Less effective implementation
      $jobHandler = $this->get('job_handler');

      $text = $jobHandler->detectText($receivedData);
      $methods = $jobHandler->detectMethods($receivedData);
       */

      /**
       * More effective implementation
       */
      preg_match("~text':\s*'(.+)'\s*'methods':\s*\[([^\]]+)~imsS", $receivedData, $matches);
      $text = str_replace("\'", "'", $matches[1]);
      preg_match_all('~\w+~', $matches[2], $matches);
      $methods = $matches[0];

      $job->setMethods($methods);

      $textHandler = $this->get('text_handler');
      $textHandler->setText($text);
      $textHandler->addMethods($methods);

      $handledData = '{' . PHP_EOL . '' . '    \'text\': \'' .
        $textHandler->handle() . '\'' . PHP_EOL . '}';
      $job->setHandledData($handledData);

      $em->persist($job);
      $em->flush();

      $errors = $textHandler->getErrors();
      $id = $job->getId();

      $job = new Job();
      $form = $this->createForm(JobType::class, $job);
    }

    /**
     * Job's list showing
     */
    $jobs = $em->getRepository(Job::class)->findAll();

    return $this->render('Job/index.html.twig', [
      'form'    => $form->createView(),
      'jobs'    => $jobs,
      'id'      => $id,
      'errors'  => $errors
    ]);
  }

  /**
   * Deletes a job entity
   *
   * @Route("/{id}", requirements={"id" = "\d+"}, name="job_delete")
   * @Method("GET")
   * @param Request $request
   * @param Job $job
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function delete(Request $request, Job $job)
  {
    $em = $this->getDoctrine()->getManager();
    $em->remove($job);
    $em->flush();

    return $this->redirectToRoute('job_index');
  }
}
