<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Shipping\Calculator;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Shipping\Model\ShipmentInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FlatRateCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\Shipping\Calculator\FlatRateCalculator');
    }

    function it_should_implement_Sylius_shipping_calculator_interface()
    {
        $this->shouldImplement('Sylius\Component\Shipping\Calculator\CalculatorInterface');
    }

    function it_is_configurable()
    {
        $this->shouldBeConfigurable();
    }

    function it_has_required_amount_configuration_options(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array('amount'))->shouldBeCalled()->willReturn($resolver);
        $resolver->setAllowedTypes(array('amount' => array('numeric')))->shouldBeCalled()->willReturn($resolver);

        $this->setConfiguration($resolver);
    }

    function it_returns_flat_rate_configuration_form_type()
    {
        $this->getConfigurationFormType()->shouldReturn('sylius_shipping_calculator_flat_rate_configuration');
    }

    function it_should_calculate_the_flat_rate_amount_configured_on_the_method(ShipmentInterface $shipment)
    {
        $this->calculate($shipment, array('amount' => 1500))->shouldReturn(1500);
    }
}
