<?php

namespace SantorinBundle\Controller;

use SantorinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


// http://www.foulquier.info/tutoriaux/mise-en-place-d-une-api-rest-avec-fosrestbundle-dans-symfony-2
class UsersController extends Controller
{
    /**
     * @return array
     * @View()
     * @ApiDoc(
     *     resource=true,
     *     resourceDescription="Retrieve list of users.",
     *     description="Retrieve list of users",
     *     statusCodes={
     *         400 = "Validation failed."
     *     },
     *     responseMap={
     *      200 = "SantorinBundle\Entity\User"
     *     }
     *  )
     */
    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('SantorinBundle:User')->findAll();

        return array('users' => $users);
    }

    /**
     * @param $id
     * @return array
     * @View()
     */
    public function getUserAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('SantorinBundle:User')->find($id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found');
        }
        return array('user' => $user);
    }
}
 