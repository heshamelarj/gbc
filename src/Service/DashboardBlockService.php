<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/22/19
 * Time: 12:24 AM
 */

namespace App\Service;


use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DashboardBlockService extends AbstractBlockService
{

    public function __construct(?string $name = null, EngineInterface $templating = null)
    {
        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Dashboard Block';
    }
    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                'title'                 =>  'Projects Progress',
                'template'              =>  'admin/dashboard.html.twig'
        ]
        );

    }
    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('title', 'text', array('required' => false)),
            ),
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('settings[title]')
                ->assertNotNull(array())
                ->assertNotBlank()
                ->assertMaxLength(array('limit' =>  50))
            ->end();

    }
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {


        $settings = $blockContext->getSettings();

        return $this->renderResponse($blockContext->getTemplate(),[
            'block'     =>      $blockContext->getBlock(),
            'settings'  =>  $settings
        ],$response);
    }

}