<?php

/**
 * Formata data do padrão YYYY-MM-DD para DD/MM/YYYY
 * @param string $date
 * @return string
 */
function formatDate($date)
{
    return date('d/m/Y', strtotime($date));
}

/**
 * Função para debugar
 * @param * $var
 */
function debugPhp($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit;
}

function debugFiles()
{
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES);
    echo '</pre>';
    exit;
}

/**
 * Popula o dropdown
 * @param array $list Lista com os dados
 * @param string $value Valor que será setado como value do option
 * @param string $text Texto que será setado como texto do option
 * @param string $idSelected Valor que será setado como selected do option
 * @return string
 */
function fillDropdown($list, $value, $text, $idSelected = '')
{
    $options = '';
    foreach ($list as $item) {

        $selected = $item->$value == $idSelected ? 'selected' : '';
        $options .= '<option value="' . $item->$value . '" ' . $selected . '>' . $item->$text . '</option>';
    }
    return $options;
}

function sendAlert()
{
    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success" role="alert">
                            <strong>Sucesso!</strong> Operação realizada com sucesso.
                        </div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong> Não foi possível realizar a operação.
                        </div>';
                break;
            default:
                $mensagem = '<div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong> Não foi possível realizar a operação.
                        </div>';
                break;
        }
    }

    return $mensagem;
}
