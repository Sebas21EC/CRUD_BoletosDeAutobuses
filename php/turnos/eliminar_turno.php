<div class="modal fade" id="deleteChildresn<?php echo $dataTurno['id_turno']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align: center;">
        <div >
            <h4 >
                ¿Realmente deseas eliminar este turno?
            </h4>
        </div>

        <div >
          <strong style="text-align: center !important"> 
            <?php echo $dataTurno['id_turno']; ?>
        
          </strong>
        </div>
        
        <div >
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger btnBorrar" data-dismiss="modal" id="<?php echo $dataTurno['id_turno']; ?>">Borrar</button>
        </div>
        
        </div>
      </div>
</div>