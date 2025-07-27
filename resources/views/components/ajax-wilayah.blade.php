<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        provinsiSelect.addEventListener('change', function () {
            fetch(`/api/wilayah/kabupaten/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    data.forEach(kab => {
                        kabupatenSelect.innerHTML += `<option value="${kab.id}">${kab.nama}</option>`;
                    });

                    // Reset kecamatan dan kelurahan
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                });
        });

        kabupatenSelect.addEventListener('change', function () {
            fetch(`/api/wilayah/kecamatan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(kec => {
                        kecamatanSelect.innerHTML += `<option value="${kec.id}">${kec.nama}</option>`;
                    });

                    // Reset kelurahan
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                });
        });

        kecamatanSelect.addEventListener('change', function () {
            fetch(`/api/wilayah/kelurahan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                    data.forEach(kel => {
                        kelurahanSelect.innerHTML += `<option value="${kel.id}">${kel.nama}</option>`;
                    });
                });
        });
    });
</script>
