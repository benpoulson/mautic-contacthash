<?php

namespace MauticPlugin\InstantSegmentsBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactHashIntegration extends AbstractIntegration
{

    protected $coreIntegration = true;

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'ContactHash';
    }


    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getAuthenticationType()
    {
        return 'none';
    }
}
