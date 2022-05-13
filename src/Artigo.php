<?php

namespace Alura\Curso;

use mysqli;

class Artigo
{
    private mysqli $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function adicionarArtigo(string $titulo, string $conteudo): void
    {
        $query = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES (?, ?);');
        $query->bind_param('ss', $titulo, $conteudo);
        $query->execute();
    }

    public function editarArtigo(string $id, string $titulo, string $conteudo): void
    {
        $query = $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id=?;');
        $query->bind_param('sss', $titulo, $conteudo, $id);
        $query->execute();
    }

    public function excluirArtigo(string $id): void
    {
        $query = $this->mysql->prepare('DELETE FROM artigos WHERE id=?');
        $query->bind_param('s', $id);
        $query->execute();
    }

    public function exibirTodosArtigos(): array
    {
        $query = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos;');
        $artigos = $query->fetch_all(MYSQLI_ASSOC);

        return $artigos;
    }

    public function encontrarPorId(string $id): array
    {
        $query = $this->mysql->prepare('SELECT id, titulo, conteudo FROM artigos WHERE id=?;');
        $query->bind_param('s', $id);
        $query->execute();
        $artigo = $query->get_result()->fetch_assoc();

        return $artigo;
    }
}
