(function($) {

    'use strict';

    $(document).ready(function() {



        // Tags 处理函数
        $('#tagsinput').tagsInput({
            'onAddTag':onAddTag,
            'onRemoveTag':onRemoveTag,
            'delimiter': [','],
            'defaultText':'添加标签'
        });



        /*if($("#tagsinput").val()){
            var tagsinput=$("#tagsinput").val();

            alert(tagsinput);
            //把Tag输入框内容同步到 Post表单
            $("#postform").append('<input type="hidden" name="tags" value="'+tagsinput+'"/>');
        }*/




        function onAddTag(tag){



          var tagsinput = $("#tagsinput").val();
          var AddTag = tag;

            //把Tag输入框内容同步到 Post表单
            $("#postform").append('<input type="hidden" name="tags" value="'+tagsinput+'"/>');

            //处理新建tag URL

            var url = '/admin/api/createtags';


            $.ajax({

                type: "get",

                url: url,

                data: {tagData:AddTag},

                cache:false,

                async:false,

                dataType: 'html',

                success: function(array){



                }

            });



        }

        function onRemoveTag(tag){


            var tagsinput =$("#tagsinput").val();
            //把Tag输入框内容同步到 Post表单
            $("#postform").append('<input type="hidden" name="tags" value="'+tagsinput+'"/>');

            //看看能不能把数据库里面的擦掉
            var RemovedTag = tag;
            var post_id = $('#post_id').val();


            //处理删除tag URL
            var url ='/admin/api/deletetags';

            $.ajax({

                type: "get",

                url: url,

                data: {tagData: RemovedTag, postID: post_id},

                cache:false,

                async:false,

                dataType: 'html',

                success: function(array){



                }

            });


        }

        // Initializes search overlay plugin.
        // Replace onSearchSubmit() and onKeyEnter() with 
        // your logic to perform a search and display results
        $(".list-view-wrapper").scrollbar();

        $('[data-pages="search"]').search({
            searchField: '#overlay-search',
            closeButton: '.overlay-close',
            suggestions: '#overlay-suggestions',
            brand: '.brand',
            onSearchSubmit: function(searchString) {
                console.log("Search for: " + searchString);
            },
            onKeyEnter: function(searchString) {
                console.log("Live search for: " + searchString);
                var searchField = $('#overlay-search');
                var searchResults = $('.search-results');

                clearTimeout($.data(this, 'timer'));
                searchResults.fadeOut("fast");
                var wait = setTimeout(function() {

                    searchResults.find('.result-name').each(function() {
                        if (searchField.val().length != 0) {
                            $(this).html(searchField.val());
                            searchResults.fadeIn("fast");
                        }
                    });
                }, 500);
                $(this).data('timer', wait);

            }
        })

    });

    
    $('.panel-collapse label').on('click', function(e){
        e.stopPropagation();
    })
    
})(window.jQuery);