<?php
                    include_once '../../../autoload.php';
                    $View = new View($_REQUEST,'استان');
                    $View->breadcrumbs();
                    $View->submit();
                    $View->doFill();
                    ?>
                    <section class='content'>
                        <div class='row'>
                            <div class='col-md-12'>
                                 <div class='card card-primary card-outline'>
                                    <div class='card-header'>
                                      <?
                                      $View->CardTitle();
                                    $View->refreshAndBack();
                                        ?>
                                    </div>
                                    <?=
                                    $View->FormStart().
                                    $View->Html()->FormGroupStart(6) .
                            $View->Html()->Label('نام استان') .
                            $View->Html()->Input('state_name') .
                            $View->Html()->FormGroupEnd() 
                                    ?>
                                    <?
                                    $View->CardFooter();
                                    ?>
                            </div>
                        </div>
                    </section>
                    