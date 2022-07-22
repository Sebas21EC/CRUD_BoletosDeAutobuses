<div class="modal fade" id="deleteChildresn<?php echo $dataRuta['id_ruta']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align: center;">
        <div >
            <h4 >
                ¿Realmente deseas eliminar esta ruta?
            </h4>
        </div>

        <div >
          <strong style="text-align: center !important"> 
            <?php echo $dataRuta['nombre_ruta']; ?>
        
          </strong>
        </div>
        
        <div >
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger btnBorrar" data-dismiss="modal" id="<?php echo $dataRuta['id_ruta']; ?>">Borrar</button>
        </div>
        
        </div>
      </div>
</div>