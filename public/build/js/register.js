$(document).ready(function(){function e(){return $(".select-body").length<1?!1:($(".select-body .active").on("click",function(){var e=$(this).parent(),t=e.children(".select-list");e.hasClass("open")?t.slideUp("fast",function(){e.removeClass("open")}):t.slideDown("fast",function(){e.addClass("open")})}),void $(document).on("click",function(e){0===$(e.target).closest(".select-body").length&&$(".select-body").each(function(){$(this).hasClass("open")&&$(this).children(".select-list").slideUp("fast",function(){$(this).parent().removeClass("open")})})}))}function t(){return $(".register--packets").length<1?!1:($(".register--packets .trening-select .select-list p").each(function(){0===$(this).index()&&$(this).parent().prev(".active").html($(this).html())}),void $(".register--packets .trening-select .select-list p").on("click",function(){var e=$(this),t=e.parent(),n=t.parent(),i=n.children(".active"),a=e.index(),s=n.attr("data-id"),c=$('form[data-id="'+s+'"]');c&&"undefined"!==c&&c.children('[name="warsztat"]').val(a),t.slideUp("fast",function(){i.html(e.html()),n.removeClass("open")})}))}function n(){return $(".register--packets").length<1?!1:void $(".register--packets .accommodation-select .select-list p").on("click",function(){var e=$(this),t=e.parent(),n=t.parent(),i=n.children(".active"),a=e.index()+1,s=n.attr("data-id"),c=$('form[data-id="'+s+'"]');c&&"undefined"!==c&&c.children('[name="noclegi"]').val(a),t.slideUp("fast",function(){i.html(e.html()),n.removeClass("open")})})}e(),t(),n(),$(".register--packets form input[type=submit]").on("click",function(e){var t=$(this).parents("form"),n=t.find('input[name="noclegi"]'),i=t.find('input[name="pakiet"]'),a=t.attr("data-noclegi");if(n&&i&&"yes"==a){if($active=$('.register--packets .accommodation-select[data-id="'+i.val()+'"] .active'),0==n.val()&&$active)return $active.addClass("has-error"),e.preventDefault();$active&&$active.removeClass("has-error")}})});