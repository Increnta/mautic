<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CoreBundle\Form\Type;

use Mautic\CoreBundle\Factory\MauticFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FilterType
 *
 * @package Mautic\CoreBundle\Form\Type
 */
class DateRangeType extends AbstractType
{

    private $factory;

    /**
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $humanFormat = 'M j, Y';

        $builder->add('date_from', 'text', array(
            'label'      => 'mautic.core.date.from',
            'label_attr' => array('class' => 'control-label'),
            'attr'       => array('class' => 'form-control'),
            'required'   => false,
            'data'       => empty($options['data']['date_from']) ? (new \DateTime('-30 days'))->format($humanFormat) : (new \DateTime($options['data']['date_from']))->format($humanFormat),
        ));

        $builder->add('date_to', 'text', array(
            'label'      => 'mautic.core.date.to',
            'label_attr' => array('class' => 'control-label'),
            'attr'       => array('class' => 'form-control'),
            'required'   => false,
            'data'       => empty($options['data']['date_to']) ? (new \DateTime)->format($humanFormat) : (new \DateTime($options['data']['date_to']))->format($humanFormat)
        ));

        $builder->add('apply', 'submit', array(
            'label'      => 'mautic.core.form.apply',
            'attr'       => array('class' => 'btn btn-default')
        ));

        if (!empty($options["action"])) {
            $builder->setAction($options["action"]);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "daterange";
    }
}