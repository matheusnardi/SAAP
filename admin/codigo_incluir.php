<?php
// Consulta de avaliadores
$consulta_avaliadores = mysqli_query($conn, 
"SELECT * FROM usuario WHERE tipo='avaliador' ORDER BY RAND()");

// Receber cada avaliador consultado
while ($avaliador = mysqli_fetch_array($consulta_avaliadores)) {

    $id_avaliador = $avaliador['id_usuario'];

    $projetos_avaliador = $aux;
    // Verifica se o avaliador já possui avaliações. Se sim, ele ajusta o limite de avaliações que restam ser definidas a ele.
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM avaliacao_final WHERE id_avaliador = $id_avaliador AND id_feira = $id_feira")) > 0) {
        $qntd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id_avaliador) AS qntd FROM avaliacao_final WHERE id_avaliador = $id_avaliador AND id_feira = $id_feira"))['qntd'];
        $aux = $projetos_avaliador;
        $projetos_avaliador = $projetos_avaliador - $qntd;

    }

    // Verifica se o avaliador é um professor
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao_professor WHERE id_usuario = $id_avaliador")) > 0) {
        $id_curso = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_curso FROM associacao_professor WHERE id_usuario = $id_avaliador"))['id_curso'];
        $where_curso = "AND id_curso != $id_curso";
    }
    else{
        $where_curso = "";
    }

    for ($i=0; $i < $projetos_avaliador; $i++) {

        // Consulta de um projeto que ainda não atingiu o limite de avaliações, que não foi definido para o avaliador em questão e que não seja do mesmo curso do avaliador (caso ele seja um professor)
        $consulta_projeto = mysqli_query($conn, 
        "SELECT id_projeto, id_curso FROM projeto
        WHERE id_projeto NOT IN
        ( 
            (SELECT id_projeto
            FROM avaliacao_final
            WHERE id_feira = $id_feira
            GROUP BY id_projeto 
            HAVING COUNT(*) = $avaliadores_projeto)
        )
		AND id_projeto NOT IN
        ( 
            (SELECT id_projeto
            FROM avaliacao_final
            WHERE id_avaliador = $id_avaliador AND id_feira = $id_feira
			GROUP BY id_projeto)
        )
		$where_curso
        ORDER BY RAND() LIMIT 1;
        ");

        $consulta_projeto = mysqli_fetch_array($consulta_projeto);

        $id_projeto = $consulta_projeto['id_projeto'];

        $id_curso = $consulta_projeto['id_curso'];

        $sql = "INSERT INTO avaliacao_final (id_projeto, id_avaliador, id_curso, id_feira, status_avaliacao, n1, n2, n3, n4, n5, n6, n7, n8, n9, n10, n11)
        values ('$id_projeto', '$id_avaliador', '$id_curso', '$id_feira', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";

        if (mysqli_query($conn, $sql)) {

        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br><br>";
        }

    }

}
?>