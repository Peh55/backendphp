<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atendimento extends CI_controller{

    private $json;
    private $resultado;

    private $codAtendimento;
    private $ra;
    private $idProfessor;
    private $descricao;
    private $estatus;

    public function getCodAtendimento(){
        return $this->codAtendimento;
    }
    public function getRA(){
        return $this->ra;
    }
    public function getIdProfessor(){
        return $this->idProfessor;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getEstatus(){
        return $this->estatus;
    }
    public function setCodAtendimento($codAtendimentoFront){
        $this->codAtendimento = $codAtendimentoFront;
    }
    public function setRA($raFront){
        $this->ra = $raFront;
    }
    public function setIdProfessor($idProfessorFront){
        $this->idProfessor = $idProfessorFront;
    }
    public function setDescricao($descricaoFront){
        $this->descricao = $descricaoFront;
    }
    public function setEstatus($estatusFront){
        $this->estatus = $estatusFront;
    }
    public function armazenarAtendimento(){

    }
    public function atendimentoAluno(){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $lista = array("codAtendimento" => '0',
                       "ra" => '0',
                       "idProfessor" => '0',
                       "descricao" => '0',
                       "estatus" => '0');

        if(verificarParam($resultado, $lista) == 1){

            $this->setCodAtendimento($resultado->codAtendimento);
            $this->setRA($resultado->ra);
            $this->setDescricao($resultado->descricao);
            $this->setEstatus($resultado->descricao);

            if(trim($this->getDescricao()) == ""){
                $retorno = array('codigo' => 3,
                                 'msg' => 'Descricao não informada.');
            }elseif($this->getRA() < 1 || $this->getRA() == ""){
                $retorno = array('codigo' => 5,
                                 'msg' =>  'Aluno zerado ou não cadastrado.');
            }elseif($this->getCodAtendimento() < 1){
                $retorno = array('codigo' => 4,
                                 'msg' => 'Este atendimento não consta no sistema');
            }elseif($this->getEstatus() < 1){
                $retorno = array('codigo' => 3,
                                 'msg' => 'não é um aluno');
            }else{
                $this->load->model("M_atendimento");
                $retorno = $this->M_atendimento->atendimentoAluno($this->getCodAtendimento(),$this->getRA(),$this->getDescricao(), $this->getEstatus());
            }
        }else{
            $retorno = array('codigo' => 99,
                             'msg' => 'Os campos vindos do FrontEnd não representam o método de inserção,
                              verifique.');
        }
        }
    

    public function atendimentoProfessor(){}

    public function inserirNovoAluno(){}

    public function inserirNovoProfessor(){}

}
?>