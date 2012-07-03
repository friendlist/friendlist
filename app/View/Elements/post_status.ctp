<form class="well form-inline" action="/manager/posts/add" method="post" style="padding: 10px 10px 10px 10px;">
        <select name="data[Post][status]" id="status" style="width: 100px;">
                        <option>plays</option>
                        <option>bought</option>
                        <option>wants</option>
                        <option>finished</option>
                      </select>
        <input type="text" name="data[Post][game_name]" class="input" id="game_name" style="width:240px;">
        <select name="data[Post][platform_id]" id="platform" style="width: 120px;">
                        <option>1</option>
                      </select>
        <button type="submit" class="btn" rel='tooltip' data-original-title='Post a status'><i class="icon-ok"></i></button>
 </form>