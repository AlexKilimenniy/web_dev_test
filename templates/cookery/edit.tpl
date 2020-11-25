{extends file="skeleton.tpl"}

{block name="meta-custom"}
    <title>{if $update}Редактирование кухни{elseif $new}Новая кухня{/if}</title>

    <link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_HOST}static/plugins/select2/select2.min.css">

{/block}
{block name="content"}
    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>{if $update}Редактирование {$data.name}{elseif $new}Новая кухня{/if}</h3>
                </div>
            </div>

            {if $errors}
                <div class="page-header">
                    <div class="page-title">
                        {foreach $errors as $error}
                        <h4 style="color:red;">{$error}</h4>
                        {/foreach}
                    </div>
                </div>
            {/if}

            <div class="widget-content widget-content-area add-category">
                <div class="row">
                    <div class="mx-xl-auto col-xl-10 col-md-12">
                        <div class="card card-default">
                            <div class="card-heading"><h2 class="card-title"><span>Основные данные</span></h2></div>
                            <div class="card-body">
                                <div class="card-body">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                        <div class="form-group mb-4">
                                            <div class="row">
                                                <label class="col-md-4">Наименование:</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" required name="name" type="text" value="{$data.name}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="row">
                                                <label class="col-md-4">Теги:</label>
                                                <div class="col-md-8">
                                                    <select name="tags[]" class="form-control tagging" id="mySelect2" multiple="multiple">
                                                        {foreach $tags_list as $tag}
                                                            <option value="{$tag.id}">{$tag.title}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="align-center">
                                            <input value="Submit" class="btn mt-5 mb-4" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->

    <script type="text/javascript">
        $(document).ready(function() {
            var s2 = $('#mySelect2').select2();
            var vals = [];
            {foreach $data.tags as $tag}
                vals.push({$tag});
            {/foreach}
            $('#mySelect2').select2().val(vals);
            $('#mySelect2').trigger('change');
        });
    </script>
{/block}