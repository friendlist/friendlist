<script type="text/javascript">
		$(document).ready(function(){
		var num_posts = <?=$num_posts?>;
		var loaded_posts = 0;
			$("#more_button").click(function(){
			
				$("#busy-indicator").fadeIn();
			
				loaded_posts += 10;
					
				$.get("posts/getmore/" + loaded_posts, function(data){
					$("#busy-indicator").fadeOut();
					$("#main_content").append(data);
					
					if(loaded_posts >= num_posts - 10)
					{
						$("#more_button").hide();
						//alert('hide');
					}
					
				});
 
			})
		})
</script>


<script>
var auto_refresh = setInterval(
function()
{
$('#main_content').fadeOut('slow').load('posts/latest/').fadeIn("slow");
}, 5000);
</script>