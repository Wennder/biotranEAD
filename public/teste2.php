<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>jQuery PickList Basic Example</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="js/jquery-picklist.js"></script>
        <script type="text/javascript">
            $(function()
            {
                //$("#basic").pickList();
            });
        </script>
        
        <style>
            .pickList_sourceListContainer, .pickList_controlsContainer, .pickList_targetListContainer { float: left; margin: 0.25em; }
            .pickList_controlsContainer { text-align: center; }
            .pickList_controlsContainer button { display: block; width: 100%; text-align: center; }
            .pickList_list { list-style-type: none; margin: 0; padding: 0; float: left; width: 150px; height: 75px; border: 1px inset #eee; overflow-y: auto; cursor: default; }
            .pickList_selectedListItem { background-color: #a3c8f5; }
            .pickList_listLabel { font-size: 0.9em; font-weight: bold; text-align: center; }
            .pickList_clear { clear: both; }
        </style>

    </head>

    <body>

        <div>
            <select id="basic" name="basic" multiple="multiple">
                <option value="1">Option 1</option>
                <option value="2" selected="selected">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4" selected="selected">Option 4</option>
                <option value="5">Option 5</option>
            </select>
        </div>

    </body></html>