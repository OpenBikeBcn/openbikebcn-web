<?php

namespace OPENCITY\bikesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use OPENCITY\bikesBundle\Entity\Ruta;
use OPENCITY\bikesBundle\Form\RutaType;

/**
 * Ruta controller.
 * @Security("has_role('ROLE_USER')")
 * @Route("/ruta")
 */
class RutaController extends Controller
{

    /**
     * Lists all Ruta entities.
     * @Route("/", name="ruta")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getUser()->getMyRoutes();

        return $this->render('OPENCITYbikesBundle:Ruta:index.html.twig', array(
            'entities' => $entities,
        ));
    }

     /**
      * Finds and displays a Ruta entity.
      *
      * @Route("/{id}", name="ruta_show")
      * @Method("GET")
      */

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OPENCITYbikesBundle:Ruta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ruta entity.');
        }

        return $this->render('OPENCITYbikesBundle:Ruta:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Deletes a Ruta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OPENCITYbikesBundle:Ruta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ruta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ruta'));
    }

}
