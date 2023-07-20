

function currentWard(index, data) {
    var wardName = data.wards[index].name;
    return wardName;
}

function getWard(index) {
    return currentWard(index, data);
}



fetch("wards.json")
    .then(response => { console.log(response); return response.json() })
