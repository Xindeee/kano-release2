<div>
    <h6 class="p-4">Мои опросы</h6>
    
    <div id="polls">
        <!-- Доступные редаткоры опросы -->
    {foreach $polls as %key => %poll}
        <div class="card float-start m-2" style="width: 300px;height:240px" >
            <div class="card-body">
              <h5 class="card-title">{%poll.title} <span>({%poll.answersCount})</````span></h5>
              <p class="card-text">{%poll.description}</p>
              {if $isEditor} 
                  <button type="button" class="btn btn-primary" onclick="edit_poll({%poll.id})">Редактировать</button>
                  <button type="button" class="btn btn-success" onclick="take_poll({%poll.id})">Пройти</button>
              {/if}
            </div>
        </div>
    {/foreach}    
        <!-- Создание нового опроса-->
        <div class="card float-start m-2" style="height:157.6px; width: 300px; background-color: #E5E5E5" >
            <div class="card-body pb-0">
                <p class="card-text text-center" style="cursor:pointer" onclick="location.href = '?action=show_create_interview'">
                    <i class="fas fa-plus-circle fa-3x"></i>
                </p>
              <div class="text-center">
                  <p class="text-center align-items-sm-end">создать новый опрос</p>
                </div>
            </div>
        </div>
    </div>
</div>
