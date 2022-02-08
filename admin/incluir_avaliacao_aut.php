<?php 

include 'connect.php';

// Quantidade de projetos que cada avaliador deve ter
$projetos_avaliador = $_POST['projetos_avaliador'];
$aux = $projetos_avaliador;
$max_projetos_avaliador = $_POST['max_projetos_avaliador'];

// Quantidade de avaliadores que cada projeto deve ter
$avaliadores_projeto = $_POST['avaliadores_projeto'];
$max_avaliadores_projeto = $_POST['max_avaliadores_projeto'];

$id_feira = $_POST['id_feira'];

// Inicia o programa para incluir
include 'codigo_incluir.php';

// Verifica se algum projeto ficou de fora. Se ficou, é porque o minimo de avaliações foi atingido por todos os avaliadores, então o limite terá que ser aumentado
if (mysqli_num_rows(mysqli_query($conn, 
"SELECT id_projeto, id_curso FROM projeto
WHERE id_projeto NOT IN
( 
    (SELECT id_projeto
    FROM avaliacao_final
    WHERE id_feira = $id_feira
    GROUP BY id_projeto )
)
")) > 0) {

    $projetos_avaliador = $max_projetos_avaliador;
    $aux = $projetos_avaliador;

    include 'codigo_incluir.php';

}

echo "<script type='text/javascript'>
			alert('Avaliações Definidas!');
			window.location.href = 'index.php'
			</script>";

// SELECT id_usuario FROM usuario
//         WHERE tipo = 'avaliador' and id_usuario NOT IN
//         ( 
//             (SELECT id_avaliador
//             FROM avaliacao_final
// 			WHERE id_feira = 5
//             GROUP BY id_avaliador )
//         )


// $projetos_avaliador = $_POST['projetos_avaliador'];

// $consulta_avaliadores = 
// "SELECT id_avaliador
// FROM avaliacao_final
// GROUP BY id_avaliador 
// HAVING COUNT(*) < $projetos_avaliador";

// if (mysqli_num_rows(mysqli_query($conn, $consulta_avaliadores)) > 0) {
//     $consulta_avaliadores = mysqli_query($conn, $consulta_avaliadores);
//     while ($avaliador = mysqli) {
//         # code...
//     }
// }

?>