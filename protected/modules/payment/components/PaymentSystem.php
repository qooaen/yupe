<?php

class PaymentSystem extends CComponent
{
    public $parametersFile = 'parameters.json';

    public function renderCheckoutForm(Payment $payment, Order $order, $return = false)
    {
        throw new CException("Must be implemented");
    }

    public function processCheckout(Payment $payment)
    {
        throw new CException("Must be implemented");
    }

    public function getParameters()
    {
        $class_info = new ReflectionClass($this);
        $params = json_decode(file_get_contents(dirname($class_info->getFileName()) . DIRECTORY_SEPARATOR . $this->parametersFile), true);
        return $params;
    }

    public function renderSettings($paymentSettings = array(), $return = false)
    {
        $params = $this->getParameters();
        $settings = '';
        foreach ((array)$params['settings'] as $param) {
            $variable = $param['variable'];
            $settings .= CHtml::openTag('div', array('class' => 'form-group'));
            $settings .= CHtml::label($param['name'], 'Payment_settings_' . $variable, array('class' => 'control-label'));
            if (isset($param['options'])) {
                $settings .= CHtml::dropDownList(
                    'PaymentSettings[' . $variable . ']',
                    $paymentSettings[$variable],
                    CHtml::listData($param['options'], 'value', 'name'),
                    array('class' => 'form-control')
                );
            } else {
                $settings .= CHtml::textField('PaymentSettings[' . $variable . ']', $paymentSettings[$variable], array('class' => 'form-control'));
            }
            $settings .= CHtml::closeTag('div');
        }
        if ($return) {
            return $settings;
        } else {
            echo $settings;
        }
    }
}