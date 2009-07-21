<?php
/*
* Modulo para pagamento com itau shopline paar loja oscommerce
* Andre Osti de Moura
* andreoandre [at] gmail [dot] com
*/

 class shopline {
    var $code, $title, $description, $enabled;
    
     function shopline () {
     // global $order;

      $this->code = 'shopline';
      $this->title = MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_DESCRIPTION;
		$this->enabled = MODULE_PAYMENT_ITAU_SHOPLINE_STATUS;
     }

/**********************************************************************************************
JAVA SRIPT VALIDATIONS
**********************************************************************************************/
function javascript_validation() {
	return false;
}
  
/***********************************************************************************************
FUNCTION SELECTION
***********************************************************************************************/


function selection() {
	return array('id' => $this->code,
                        'module' => $this->title);                     
}  

  
/***************************************************************************************************
FUNCTION PRE_CONFIRM_CHECK
****************************************************************************************************/

 function pre_confirmation_check() {
    }

/**************************************************************************************************
FUNCTION CONFIRMATION
**************************************************************************************************/

function confirmation() {
      global $order;
      $confirmation = array('title' => $this->title,
                            'fields' => array(array('title' => 'Clique o botão "Pagar com Itau Shopline" ao lado e após ser exibido o boleto, confirme o Pedido clicando no botão abaixo.',
                                                    'field' => tep_draw_form('form', MODULE_PAYMENT_ITAU_SHOPLINE_URL, 'post', 'name="form" onsubmit=carregabrw() target="SHOPLINE"') .
                                                               tep_draw_hidden_field('valor', $order->info['total'], '') .
                                                               tep_draw_hidden_field('cliente', $order->customer['firstname'] . ' ' . $order->customer['lastname'], '') .
                                                               tep_draw_hidden_field('endereco', $order->customer['street_address'], '') .
                                                               tep_draw_hidden_field('bairro', $order->customer['suburb'], '') .
                                                               tep_draw_hidden_field('cidade', $order->customer['city'], '') .
                                                               tep_draw_hidden_field('estado', $order->customer['state'], '') .
                                                               tep_draw_hidden_field('cep', $order->customer['postcode'], '') .
                                                               tep_draw_input_field('Itau', 'Ita&uacute; Shopline', '', 'submit', true) .
                                                               '</form>')));
      return $confirmation;
    }

/***************************************************************************************************
FUNCTION PROCESS
**************************************************************************************************/
function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }  
  
/***************************************************************************************************
INSTALACAO E REMOCAO DO MODULO SHOPLINE
***************************************************************************************************/
function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pagamento ITAU SHOPLINE (0=NAO 1=SIM)', 'MODULE_PAYMENT_ITAU_SHOPLINE_STATUS', '0', '', '6', '1', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Opcoes de Pagamento)', 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_SELECTION', 'ITAU SHOPLINE', 'Texto a ser exibido para o cliente na tela do opcoes de pagamento:', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instruções para o Cliente)', 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_CONFIRMATION', 'Seu pedido será enviado após o processamento do  sistema bancario.', 'Texto a ser exibido para o cliente na confirmacao da compra', '6', '3', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (CPF)', 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_CPF', 'Informe o cpf', 'Texto a ser exibido para o cliente na confirmacao da compra', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pagamento ITAU SHOPLINE URL', 'MODULE_PAYMENT_ITAU_SHOPLINE_URL', 'url do iatu', '', '6', '1', now())");

}	

function remove() {
   tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_STATUS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_SELECTION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_CONFIRMATION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_CPF'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_URL'");
}

/************************************************************************************************
FUNCTION CHECK
************************************************************************************************/

function check() {
    $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ITAU_SHOPLINE_STATUS'");
    $check = tep_db_num_rows($check);

    return $check;
}

/***********************************************************************************************
FUNCTION KEYS
***********************************************************************************************/

function keys() {
    $keys = array('MODULE_PAYMENT_ITAU_SHOPLINE_STATUS', 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_SELECTION', 'MODULE_PAYMENT_ITAU_SHOPLINE_TEXT_CONFIRMATION', 'MODULE_PAYMENT_ITAU_SHOPLINE_URL');
    return $keys;
    }
    
} 
    ?>

    
