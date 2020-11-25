{extends file="skeleton.tpl"}

{block name="meta-custom"}
    <title>Список кухонь</title>
{/block}
{block name="content"}
    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Кухни</h3>
                </div>
            </div>

            <div class="row margin-bottom-120">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Все кухни</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <table id="ecommerce-product-list" class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Наименование</th>
                                            <th>Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach $data_list as $item}
                                        <tr>
                                            <td>{$item.id}</td>
                                            <td>{$item.name}</td>
                                            <td class="align-center">
                                                <ul class="table-controls">
                                                    <li>
                                                        <a href="/cookery?update&id={$item.id}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="flaticon-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/cookery?remove&id={$item.id}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="flaticon-delete-5"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        {/foreach}
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->

{/block}