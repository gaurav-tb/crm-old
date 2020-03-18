function takeAction(value)
{
if(value=='c' || value=='l' || value=='sc' || value=='sl')
{
getModule('billing/changeowner?type='+value,'manipulatemoodleContent','viewmoodleContent','Change Owner');
}
else if(value == '2')
{
getModule('leads/massEdit?type='+value,'manipulatemoodleContent','viewmoodleContent','Mass Edit');
}
else if(value == '3')
{
getModule('clients/massEdit?type='+value,'manipulatemoodleContent','viewmoodleContent','Mass Edit');
}

else
{
value = value.split(":")
deleteData(value[0] ,value[1])


}

}

