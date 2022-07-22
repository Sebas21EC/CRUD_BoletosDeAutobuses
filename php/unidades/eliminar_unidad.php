<div class="modal fade" id="deleteChildresn<?php echo $dataUnidad['id_unidad']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align: center;">
        <div >
            <h4 >
                ¿Realmente deseas eliminar está unidad?
            </h4>
        </div>

        <div >
          <strong style="text-align: center !important"> 
            <?php echo $dataUnidad['id_unidad']; ?>
        
          </strong>
        </div>
        
        <div >
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger btnBorrar" data-dismiss="modal" id="<?php echo $dataUnidad['id_unidad']; ?>">Borrar</button>
        </div>
        
        </div>
      </div>
</div>