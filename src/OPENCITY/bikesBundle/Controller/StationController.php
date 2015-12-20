<?php

namespace OPENCITY\bikesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use OPENCITY\bikesBundle\Entity\Station;
use OPENCITY\bikesBundle\Form\StationType;
use OPENCITY\bikesBundle\Form\FavoriteType;

/**
 * Station controller.
 * @Security("has_role('ROLE_USER')")
 * @Route("/station")
 */
class StationController extends Controller
{

  /**
   * Lists all Station entities.
   *
   * @Route("/", name="station_home")
   * @Method("GET")
   */
    public function indexAction()
    {

		    $entities = $this->getUser()->getMyStations();
        return $this->render('OPENCITYbikesBundle:Station:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all Station entities.
     *
     * @Route("/refresh", name="station_refresh")
     * @Method("GET")
     */
    public function parserAction() {
        $str = file_get_contents('http://wservice.viabicing.cat/v2/stations');
        $json = json_decode($str, true); // decode the JSON into an associative array
        $em = $this->getDoctrine()->getManager();
        foreach ($json['stations'] as $station) {
            $entity = new Station();
            $entity->setIdBicing($station['id']);
            $entity->setName($station['id']." - ". $station['streetName']." - ".$station['streetNumber']);
            $entity->setLatitude($station['latitude']);
            $entity->setLongitude($station['longitude']);
            $em->persist($entity);
            $em->flush();
        }
    }

    /**
     * Creates a new Station entity.
     *
     * @Route("/", name="station_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $idStation = $this->get('request')->request->get('opencity_bikesbundle_station')['Station'];
      $station = $em->getRepository('OPENCITYbikesBundle:Station')->findOneById($idStation);
      $user->addMyStations($station);
      $em->persist($user);
      $em->flush();
      return $this->redirect($this->generateUrl('station_home'));
    }

    /**
     * Creates a form to create a Station entity.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm()
    {
        $entity = null;
        $form = $this->createForm(new FavoriteType(), $entity, array(
            'action' => $this->generateUrl('station_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Afegir a favorits'));

        return $form;
    }

    /**
     * Displays a form to create a new Station entity.
     *
     * @Route("/new", name="station_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = null;
        $form   = $this->createCreateForm();
        return $this->render('OPENCITYbikesBundle:Station:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Station entity.
     *
     * @Route("/{id}", name="station_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('OPENCITYbikesBundle:Station')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Station entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OPENCITYbikesBundle:Station:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Station entity.
     *
     * @Route("/delete/{id}", name="station_delete")
     * @Method("get")
     */
    public function deleteAction($id)
    {
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OPENCITYbikesBundle:Station')->find($id);


            if (!$entity) {
                throw $this->createNotFoundException('Unable to find this Favorite.');
            }

            $this->getUser()->removeMyStations($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('station_home'));
    }

    /**
     * Creates a form to delete a Station entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('station_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
