<?php

namespace App\Controller;

use App\Entity\AuditTask;
use App\Form\AuditTaskType;
use App\Repository\AuditTaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/audit/task')]
final class AuditTaskController extends AbstractController
{
    #[Route(name: 'app_audit_task_index', methods: ['GET'])]
    public function index(AuditTaskRepository $auditTaskRepository): Response
    {
        return $this->render('audit_task/index.html.twig', [
            'audit_tasks' => $auditTaskRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_audit_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $auditTask = new AuditTask();
        $form = $this->createForm(AuditTaskType::class, $auditTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($auditTask);
            $entityManager->flush();

            return $this->redirectToRoute('app_audit_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audit_task/new.html.twig', [
            'audit_task' => $auditTask,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_audit_task_show', methods: ['GET'])]
    public function show(AuditTask $auditTask): Response
    {
        return $this->render('audit_task/show.html.twig', [
            'audit_task' => $auditTask,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_audit_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AuditTask $auditTask, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AuditTaskType::class, $auditTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_audit_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audit_task/edit.html.twig', [
            'audit_task' => $auditTask,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_audit_task_delete', methods: ['POST'])]
    public function delete(Request $request, AuditTask $auditTask, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auditTask->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($auditTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_audit_task_index', [], Response::HTTP_SEE_OTHER);
    }
}
