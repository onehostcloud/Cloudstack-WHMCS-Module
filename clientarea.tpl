
<div class="text-center module-client-area">
    <link href="modules/servers/cloudstack/css/style.css" rel="stylesheet" type="text/css">

    <div id="wrapper">
        <section class="manage_content"><!-- maincontent starts -->
            <div class="row"><!-- row starts -->
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12 col-sm-12"><!-- col-12 starts -->
                    <div id="custon_tab_container"></div>
                    <div class="manage_tab_sec">
                        {if !isset($smarty.get.page)}
                            {assign var=select value="style='background: #006687;transition: all 0.4s ease 0s;color: white;'"}
                        {/if}
                        {if $smarty.get.page=='actions'}
                            {assign var=select1 value="style='background: #006687;transition: all 0.4s ease 0s;color: white;'"}
                        {/if}
                        {if $smarty.get.page=='logs'}
                            {assign var=select2 value="style='background: #006687;transition: all 0.4s ease 0s;color: white;'"}
                        {/if}

                        <ul class="manage_tab_menu">
                            <li >
                                <a {$select} href="clientarea.php?action=productdetails&id={$smarty.get.id}"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                    <p>Details</p>
                                </a>
                            </li>
                            <li >
                                <a {$select1} href="clientarea.php?action=productdetails&page=actions&id={$smarty.get.id}"><i class="fa fa-microchip" aria-hidden="true"></i>
                                    <p>Actions</p>
                                </a>
                            </li>
                            {* <li>
                            <a href="clientarea.php?action=productdetails&page=rebuild&id={$smarty.get.id}"><i class="fa fa-code" aria-hidden="true"></i>
                            <p>Rebuild</p>
                            </a>
                            </li>*}
                            <li >
                                <a {$select2} href="clientarea.php?action=productdetails&page=logs&id={$smarty.get.id}" ><i class="fa fa-line-chart" aria-hidden="true"></i>
                                    <p>Logs</p>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                        <!-- if vm in not available or not created condition end -->
                        <div id="details">
                            {if $smarty.get.page=='logs'}
                                <table class='table'>
                                    <tr>
                                        <td>Command</td><td>Date</td><td>Status</td>
                                    </tr>
                                    {foreach from=$logs item=log}
                                        {assign var=cmd value="."|explode:$log->cmd}

                                        <tr>
                                            <td>{($cmd|@end)|replace:'CmdByAdmin':''}</td><td>{$log->created}</td><td>{$log->jobresult->errortext}</td>
                                        </tr>
                                    {/foreach}
                                </table>
                            {elseif $smarty.get.page=='actions'} 
                                <div style='float:left;'>
                                    <br><br><br>
                                    <a type="button" href="clientarea.php?action=productdetails&modop=custom&a=start&id={$smarty.get.id}" class="btn">Start</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a type="button" href="clientarea.php?action=productdetails&modop=custom&a=stop&id={$smarty.get.id}" class="btn btn-default">Stop</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a type="button" href="clientarea.php?action=productdetails&modop=custom&a=Restart&id={$smarty.get.id}" class="btn btn-primary">Restart</a>
                                    </tr>

                                </div>                               

                            {elseif $smarty.get.page=='rebuild'}     
                                <form method="post" action="clientarea.php?action=productdetails&id={$serviceid}">
                                    {$response}
                                    <br><br>
                                    <input type="hidden" name="a" value="rebuild" />
                                    <table style="width:100%;">
                                        <tr>
                                            <td>Zone:</td><td> <select name="zone" class="form-control">
                                                    {$zone}
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>Service Offering:</td><td><select name="serviceoffer" class="form-control">
                                                    {$serviceoffer}
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>Template:</td><td>  <select name="template" class="form-control">
                                                    {$template}
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>Disk Offering:</td><td> <select name="diskoffer" class="form-control">
                                                    {$diskoffer}
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>Domain Name :</td><td><input type="text" class="form-control" name="domainname" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td>Server Name :</td><td><input type="text" class="form-control" name="prefix" placeholder="Example: EXAMPLE"></td>
                                        </tr>
                                        <tr>
                                            <td></td><td> <input type="submit" name="submit" class="btn btn-default" value="Build  VM!">  </td>
                                        </tr>
                                    </table> 


                                </form>  

                            {else} 
                                <table style="width:100%;" class="table">
                                    <tr>
                                        <td>Name :</td><td>{$virtualmachine->displayname}</td>
                                    </tr>
                                    <tr>
                                        <td>Username: </td><td>{$virtualmachine->username}</td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td><td>{$virtualmachine->state}</td>
                                    </tr>
                                    <tr>
                                        <td>Template Name:</td><td>{$virtualmachine->templatename}</td>
                                    </tr>
                                    <tr>
                                        <td>Disk:</td><td>{$virtualmachine->diskofferingname}</td>
                                    </tr>
                                    <tr>
                                        <td>Passord:</td><td>{$virtualmachine->details->password}</td>
                                    </tr>
                                    <tr>
                                        <td>Memory</td><td>{$virtualmachine->memory} MB</td>
                                    </tr>
                                </table>  
                            {/if}
                        </div>

                    </div><!-- manage_tab_sec -->
                </div><!-- col-12 end -->
            </div><!-- row end -->
        </section></div><!-- wrapper-->
</div>

