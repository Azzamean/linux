jQuery(document).ready(function ($) {
    // GET DATA
    async function getdata() {
        let url = await fetch('https://scan.sv-1.dev.global.canton.network.sync.global/api/scan/v0/scans')
        let data = await url.json();
        return data
    }

    // USE DATA
    getdata().then(data => {
        data.scans.forEach((items, index) => {
            const length = items.scans.length;
            var html = "";
            html += "<ul>"

            for (let i = 0; i < length; i++) {
                console.log(items.scans[i].publicUrl);
                html += "<li>" + items.scans[i].publicUrl + "</li>";
            }

            html += "</ul>";
            $("#syncapi").append(html);
        })
    });
});