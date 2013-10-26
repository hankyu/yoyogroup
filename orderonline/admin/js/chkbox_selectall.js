// JavaScript Document
        function init_chkBox(pattern_id){
			var counter = 0;
			//³]©w¨Ó·½ GridView ID => var pattern = '^XFUNGridView1';
			var pattern = pattern_id;
			AttachListener();
		}
        // Get the checkboxes inside the Gridview which is part of the template column
        function GetChildCheckBoxCount() 
        {    
            var checkBoxCount = 0;  
            
            var elements = document.getElementsByTagName("INPUT"); 
            
            for(i=0; i<elements.length;i++) 
            {
                if(IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) checkBoxCount++; 
            }
            
           return parseInt(checkBoxCount); 
        }

        // A function that checks if the checkboxes are the one inside the GridView 
        function IsMatch(id) 
        {
            var regularExpresssion = new RegExp(pattern); 
            
            if(id.match(regularExpresssion)) return true; 
            else return false; 
        }

        function IsCheckBox(chk) 
        {
            if(chk.type == 'checkbox') return true; 
            else return false;
        }


        function AttachListener()
        {
            var elements =  document.getElementsByTagName("INPUT");
            
            for(i=0; i< elements.length; i++) 
            {       
                if( IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) 
                {
                    AddEvent(elements[i],'click',CheckChild); 
                }
            }    
        }

        function CheckChild(e) 
        {
            var evt = e || window.event; 
            
            var obj = evt.target || evt.srcElement 
          
            if(obj.checked)
            {
                if(counter < GetChildCheckBoxCount()) 
                    { counter++; }        
            }    
                    
            else 
            {
               if(counter > 0) { counter--; }    
            } 
               
            if(counter == GetChildCheckBoxCount()) 
            { document.getElementById("chkAll").checked = true; } 
            else if(counter < GetChildCheckBoxCount()) { document.getElementById("chkAll").checked = false; }    
          
        }

        function AddEvent(obj, evType, fn) 
        {
            if (obj.addEventListener)
            {
            obj.addEventListener(evType, fn, true);
            return true;
            }
         
         else if (obj.attachEvent)
         {
            var r = obj.attachEvent("on"+evType, fn);
            return r;
         }
          else
           {
            return false;
           }    
        }


        function Check(parentChk) 
        {
            var elements =  document.getElementsByTagName("INPUT"); 
            
            for(i=0; i<elements.length;i++) 
            {
                if(parentChk.checked == true) 
                {  
                    if( IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) 
                    {
                    elements[i].checked = true; 
                    }         
                }
                else 
                {
                    elements[i].checked = false; 
                    // reset the counter 
                    counter = 0; 
                }       
            }
            
            if(parentChk.checked == true) 
            {
                counter = GetChildCheckBoxCount(); 
            }   
               
        }

