
    function choicetype(but1,but2,but3){
            document.getElementById(but1).style.display = 'block';
            document.getElementById(but2).style.display = 'none';
            document.getElementById(but3).style.display = 'none';
        }
        
      function date(){
        var now=new Date();
        var x = document.getElementById("date");
        x.innerHTML=now.toUTCString();
         }
         
        function quiz($N) {
                document.getElementById($N);
        }
        
        function Countdown() {
        this.start_time = "30:00";
        this.targer_id = "#timer";
        this.name = "timer";
        }
        Countdown.prototype.init = function(){
        this.reset();
        setInterval(this.name+'.tick()',1000);
        }
        Countdown.prototype.reset = function(){
        time = this.start_time.split(":");
        this.minutes = parseInt(time[0]);
        this.seconds = parseInt(time[1]);
        this.update_target();
        }
        Countdown.prototype.tick = function(){
        if (this.seconds > 0 || this.minutes > 0) {
        
        if (this.seconds==0) {
            this.minutes = this.minutes - 1;
            this.seconds = 59;
        }else{
        this.seconds = this.seconds - 1;
                }
        }
        this.update_target();
        }
        Countdown.prototype.update_target = function(){
        seconds = this.seconds;
        if (seconds < 10) {
                seconds = "0" + seconds;
        }
        $(this.targer_id).val(this.minutes+":"+seconds);
        }
