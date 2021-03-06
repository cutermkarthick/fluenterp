<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CalendarView — JavaScript Calendar Widget</title>
    <link rel="stylesheet" href="css/calendarview.css">
    <style>
      body {
        font-family: Trebuchet MS;
      }
      div.calendar {
        max-width: 500%;
        margin-left: auto;
        margin-right: auto;
        height: 100%;
        margin-bottom: -10%;
        
      }
      div.calendar table {
        width: 100%;
        height:100%;
      }
      div.dateField {
        width: 140px;
        padding: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        color: #555;
        background-color: white;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      }
      div.calendar td.title {
            padding: 6px 0 6px 10px;
        }


      div#popupDateField:hover {
        background-color: #cde;
        cursor: pointer;
      }
    </style>
    <script src="scripts/prototype.js"></script>
    <script src="scripts/calendarview.js"></script>
    
    <script>
      function setupCalendars() {
        // Embedded Calendar
        Calendar.setup(
          {
            // dateField: 'embeddedDateField',
            parentElement: 'embeddedCalendar'
          }
        )

        // Popup Calendar
        // Calendar.setup(
        //   {
        //     dateField: 'popupDateField',
        //     triggerElement: 'popupDateField'
        //   }
        // )
      }

      Event.observe(window, 'load', function() { setupCalendars() })
    </script>
  </head>
  <body>

    <!-- <div style="float: left; width: 50%">
      <div style="height: 400px; background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
        <h3 style="text-align: center; background-color: white; -webkit-border-radius: 10px; -moz-border-radius: 10px; margin-top: 0px; margin-bottom: 20px; padding: 8px">
          Embedded Calendar
        </h3> -->
        <div id="embeddedExample">
          <div id="embeddedCalendar" style="font-family:BebasNeueRegular,Arial,Helvetica,sans-serif;margin-left: auto; margin-right: auto;font-weight:normal;color: white;font-size: 120%;">
          </div>
          <br />
          <!-- <div id="embeddedDateField" class="dateField">
            Select Date
          </div> -->
          <br />
        </div>
      </div>
    </div>
<!--     <div style="float: right; width: 50%">
      <div style="height: 400px; background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-left: 10px">
        <h3 style="text-align: center; background-color: white; -webkit-border-radius: 10px; -moz-border-radius: 10px; margin-top: 0px; margin-bottom: 20px; padding: 8px">
          Popup Calendar
        </h3>
        <div id="popupExample">
          <div id="popupDateField" class="dateField" style="margin-top: 160px">
            Show Calendar
          </div>
        </div>
      </div>
    </div> -->

  </body>
</html>