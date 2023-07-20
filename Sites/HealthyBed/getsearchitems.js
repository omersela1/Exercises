
function showSelectedWard(data) {
    var drop_down = document.getElementById("wardList");

    for (key in data.wards) {
        const option = document.createElement('option');
        option.value = data.wards[key].name;
        option.innerHTML = data.wards[key].name;
        drop_down.appendChild(option);
    }

    const wardQueryString = location.search;
    const drop_down_val = new URLSearchParams(wardQueryString);
    if (!drop_down_val.get('ward'))
        drop_down.value = "All Wards";
    else
        drop_down.value = drop_down_val.get('ward');


    var occupancy = document.getElementById("sortList");
    if (drop_down_val.get('sort')) {
        occupancy.value = drop_down_val.get('sort');
    }
    else {
        occupancy.value = "all";
        drop_down_val.append('sort', occupancy.value);

    }
    occupancy.addEventListener('input', function () {
        drop_down_val.delete('sort');
        drop_down_val.append('sort', occupancy.value);
        if (drop_down.value != "All Wards") {
            document.location.href = "search.php?ward=" + drop_down.value + "&sort=" + drop_down_val.get('sort');
        }
        else
            document.location.href = "search.php?sort=" + drop_down_val.get('sort');

    })

    drop_down.addEventListener('input', function () {

        if (drop_down.value != "All Wards") {
            document.location.href = "search.php?ward=" + drop_down.value + "&sort=" + drop_down_val.get('sort');
        }
        else
            document.location.href = "search.php?sort=" + drop_down_val.get('sort');
    })

}

function getClick(id, bedNum) {
    var icon = document.getElementById(id);
    icon.onclick = function () {
        window.location.href = 'bed.php?id=' + bedNum;

    };
};

fetch("wards.json")
    .then(response => { console.log(response); return response.json() })
    .then(data => showSelectedWard(data));