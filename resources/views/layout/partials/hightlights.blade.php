<div class="highlights">
    <div class="highlights-header">
     <h2 style="margin:0; padding:0 20px; line-height:40px; font-size:15px; color: #FFF; height: 39px; box-sizing: border-box; text-transform: uppercase; font-weight: 700; ">Highlights</h2>
     <span style="margin: 0; position: absolute; right: -10px; top: 10px; height: 0; border-style: solid; border-width: 10px 0 10px 10px; border-color: transparent transparent transparent #3390ff;"></span>
    </div>
  <marquee class="scrol-text " style="padding: 5px 0px 5px 0px;" onmouseout="this.start()" onmouseover="this.stop()">
    ***&nbsp;<a href="/circuler-baf-ro" ><span id="noticeName"></span> : <span id="noticeSubject"></span></a>&nbsp;***
  </marquee>
  </div>
  <script>
    getList();
    async function getList(){
        let res = await axios.get(`/circular-notice`);
        let name = res.data.data['name'];
        let subject = res.data.data['subject'];
        document.getElementById('noticeName').innerHTML = name;
        document.getElementById('noticeSubject').innerHTML = subject;

    }
  </script>
