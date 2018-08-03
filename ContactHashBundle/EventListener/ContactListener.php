<?php


namespace MauticPlugin\InstantSegmentsBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\EmailBundle\EventListener\MatchFilterForLeadTrait;
use Mautic\LeadBundle\Entity\LeadList;
use Mautic\LeadBundle\Event\LeadEvent;
use Mautic\LeadBundle\LeadEvents;
use Mautic\PluginBundle\Helper\IntegrationHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContactListener extends CommonSubscriber
{

    use MatchFilterForLeadTrait;

    /**
     * @var IntegrationHelper
     */
    private $helper;
    private $container;

    /**
     * ButtonSubscriber constructor.
     *
     * @param IntegrationHelper $helper
     * @param ContainerInterface $container
     */
    public function __construct(
        IntegrationHelper $helper,
        ContainerInterface $container
    )
    {
        $this->helper = $helper;
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return [
            LeadEvents::LEAD_POST_SAVE      => ['onLeadPostSave', 0],
        ];
    }

    public function onLeadPostSave(LeadEvent $event)
    {

        /** @var \Mautic\LeadBundle\Model\LeadModel $leadModel */
        $leadModel = $this->container->get('mautic.lead.model.lead');
        $lead = $leadModel->getEntity($event->getLead()->getId());
        $leadModel->setFieldValues($lead, ['hash' => hash('sha256', $lead->getEmail())]);
        $leadModel->saveEntity($lead);
    }

}
