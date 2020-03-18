<?php

$output = '

<div style="padding:5px;font-size:11px;" id="sbi-wlist">

<link id="style1" href="http://demo.gocrm.co.in/css/style.css" type="text/css" rel="stylesheet"><table cellpadding="0" cellspacing="0" width="100%" align="center" border="0" class="fetch" style="font-size:10px;"><tbody><tr height="20px"><td style="font-size:11px;" class="GridHeadL Rborder" height="25">
                                                                            COMPANY</td>
                                                                        <td style="font-size:11px;" class="GridHeadC Rborder">
                                                                            BSE Code</td>
                                                                        <td style="font-size:11px;" class="GridHeadC">
                                                                            NSE Symbol</td>
                                                                    </tr>
                                                                
                                                                    <tr class="AltR1bgcolor">
                                                                        <td style="font-size:11px;" class="GridDataL Rborder" width="44%">
                                                                            <a target="_blank" href="quote/getin.php?id=401&amp;opt=1&amp;cocode=34918&amp;symbol=SBIGETS" class="MktDataLink">
                                                                                SBI Gold ETS
                                                                            </a>
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC Rborder" width="28%">
                                                                            590098
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC" width="28%">
                                                                            SBIGETS
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                
                                                                    <tr class="AltR2bgcolor">
                                                                        <td style="font-size:11px;" class="GridDataL Rborder" width="44%">
                                                                            <a target="_blank" href="quote/getin.php?id=401&amp;opt=1&amp;cocode=2860&amp;symbol=SBIHOMEFIN" class="MktDataLink">
                                                                                SBI Home Finance Ltd
                                                                            </a>
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC Rborder" width="28%">
                                                                            500379
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC" width="28%">
                                                                            SBIHOMEFIN
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                
                                                                    <tr class="AltR1bgcolor">
                                                                        <td style="font-size:11px;" class="GridDataL Rborder" width="44%">
                                                                            <a target="_blank" href="quote/getin.php?id=401&amp;opt=1&amp;cocode=1375&amp;symbol=SBIN" class="MktDataLink">
                                                                                State Bank of India
                                                                            </a>
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC Rborder" width="28%">
                                                                            500112
                                                                        </td>
                                                                        <td style="font-size:11px;" class="GridDataC" width="28%">
                                                                            SBIN
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                
                                                        </tbody></table></div>';
                                                        
                            
                                                        
                                            $html = explode("quote/getin.php?",$output);
                                          
                                            foreach($html as $val)
                                            {
                                            if(array_search($val,$html) != 0)
                                            {
                                            
                                            $temp = explode(' class="MktDataLink"',$val);
                                           // print_r($val);
                                           
                                           	$sepLink[] .= str_ireplace('"',"",$temp[0]);
                                           	
                                            }
                                            }
                                            
                                            foreach($sepLink as $gal)
                                            {
                                            $toreplace = $gal.'" onclick="getModule(\'quote/getin?'.$gal.'\',\'viewmoodleContent\',\'\',\'\')';
                                            $output = str_ireplace($gal,$toreplace,$output);
                                            }
                                                        
                                                        echo $output;


?>
