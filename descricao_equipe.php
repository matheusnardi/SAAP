<div class="row">
    <div class="col">
        <h3 class="mb-3 font-weight-bold" style="margin-top: 15px; border-bottom: 1px solid #A8A8A8; padding-bottom: 10px; width: 300px">Descrição</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <form action="editar_descricao.php" method="post">

            <div class="form-group">
                <textarea class="form-control" name="descricao" rows="6" style="width: 300px;"><?php echo $equipe['descricao'] ?></textarea>
            </div>
            <input type='text' hidden name='id_curso' value='$id_curso'>
            <button type="submit" name="id_equipe" value="<?php echo $id_equipe; ?>" class="btn btn-outline-success" style=" width: 300px;">Atualizar Descrição</button>

        </form>
    </div>
</div>