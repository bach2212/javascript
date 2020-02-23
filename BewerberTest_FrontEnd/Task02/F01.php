<?php

/**
 * This function generates a new user. But in this function are 2 typical syntax errors hidden.
 * Can you find all of them?
 *
 * EDIT HERE:
 *
 * 1.
 *  Line:
 *  Error description:
 *
 * 2.
 *  Line:
 *  Error description:
 *
 *
 */

public function createUserAction(Request $request) {
    if(!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
      throw $this->createAccessDeniedException();
    }
    $em = $this->getDoctrine()->getManager();
    $user = new User()
    $form = $this->createForm(UserType::class, $user, ['method' => 'POST']);
    $form->submit($request->request->all(), true);
    if($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();
        $tokenGenerator = new UriSafeTokenGenerator();

        $randomString = $this->generateRandomString();
        $user->setPlainPassword($randomString);

        $googleAuthenticator = new GoogleAuthenticator();
        $secret = $g->generateSecret();
        $user->setSecret2fa($secret);
        $user->setAttempts(0);
        $user->setIsActive(true);

        $em->persist($user);
        $em->flush();

        $qrCode = GoogleQrUrl::generate($user->getEmail(), $secret, "MedexoGmbH");
        $this->buildCreateUserEmail($user, $randomString, $qrCode);

        $view = new View($qrCode, Response::HTTP_CREATED);
        $view->setHeader('Location', $this->generateUrl('api_user_get',
          ['version' => $request->attributes->get('version'),
          'id' => $user->getId()->toString()], UrlGeneratorInterface::ABSOLUTE_URL));
        return $view;
    }
    return new View($form, Response::HTTP_BAD_REQUEST);
}
