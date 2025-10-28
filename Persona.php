<?php
class Persona {
    private $nome;
    private $cognome;
    private $data_nascita;
    private $codice_fiscale;

    public function __construct($nome, $cognome, $data_nascita, $codice_fiscale) {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->data_nascita = $data_nascita;
        $this->codice_fiscale = $codice_fiscale;
    }

    public function toCard() {
        return "
        <div class='card'>
            <p><strong>Nome:</strong> {$this->nome}</p>
            <p><strong>Cognome:</strong> {$this->cognome}</p>
            <p><strong>Data di nascita:</strong> {$this->data_nascita}</p>
            <p><strong>Codice Fiscale:</strong> {$this->codice_fiscale}</p>
        </div>
        ";
    }

    public function toArray() {
        return [
            "nome" => $this->nome,
            "cognome" => $this->cognome,
            "data_nascita" => $this->data_nascita,
            "codice_fiscale" => $this->codice_fiscale
        ];
    }
}
?>
