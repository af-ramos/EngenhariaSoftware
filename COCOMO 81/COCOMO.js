function gerarTabela() {
    var html = "";

    const tabela = [
        ["RELY", "0.75", "0.88", "1.00", "1.15", "1.40", "----"],
        ["DATA", "----", "0.94", "1.00", "1.08", "1.16", "----"],
        ["CPLX", "0.70", "0.85", "1.00", "1.15", "1.30", "1.65"],
        ["TIME", "----", "----", "1.00", "1.11", "1.30", "1.66"],
        ["STOR", "----", "----", "1.00", "1.06", "1.21", "1.56"],
        ["VIRT", "----", "0.87", "1.00", "1.15", "1.30", "----"],
        ["TURN", "----", "0.87", "1.00", "1.07", "1.15", "----"],
        ["ACAP", "1.46", "1.19", "1.00", "0.86", "0.71", "----"],
        ["AEXP", "1.29", "1.13", "1.00", "0.91", "0.82", "----"],
        ["PCAP", "1.42", "1.17", "1.00", "0.86", "0.70", "----"],
        ["VEXP", "1.21", "1.10", "1.00", "0.90", "----", "----"],
        ["LEXP", "1.14", "1.07", "1.00", "0.95", "----", "----"],
        ["MODP", "1.24", "1.10", "1.00", "0.91", "0.82", "----"],
        ["TOOL", "1.24", "1.10", "1.00", "0.91", "0.83", "----"],
        ["SCED", "1.23", "1.08", "1.00", "1.04", "1.10", "----"],
    ];

    html += '<tbody>';

    for (var i = 0; i < 15; i++) {
        html += '<tr> <td class="atributo">' + tabela[i][0] + '</td>';
        for (var j = 1; j < 7; j++) {
            html += '<td> <input type="radio" class="botaoRadio form-check-input" value="' + tabela[i][j] + '" name=' + tabela[i][0] + ' ' + (j == 3 ? "checked" : " ") + ' ' + (tabela[i][j] == "----" ? "disabled" : " ") + '>' + (tabela[i][j] == "----" ? " " : tabela[i][j]) + '</td>';
        }
        html += '</tr>';
    }

    html += '</tbody>';

    document.getElementById("tabela").innerHTML += html;
}

function calcularEsforcoAjustado(multiplicadoresEsforco) {
    var total = 1.0;

    for (var i = 0; i < multiplicadoresEsforco.length; i++)
        total *= multiplicadoresEsforco[i];

    return total;
}

function calcularCOCOMO() {
    var multiplicadoresEsforco = [], atributos = ["RELY", "DATA", "CPLX", "TIME", "STOR", "VIRT", "TURN", "ACAP", "AEXP", "PCAP", "VEXP", "LEXP", "MODP", "TOOL", "SCED"];
    var formulario, kdsi, estTempo, unidadeTempo, modoDesenvolvimento, esforcoBruto, esforcoAjustado, prazo, tamanhoEquipe;

    formulario = document.getElementById("formulario").elements;

    kdsi = formulario["kdsi"].value;
    estTempo = formulario["estTempo"].value;
    unidadeTempo = estTempo == 1 ? "meses" : (estTempo == 152 ? "horas" : (estTempo == 19 ? "dias" : "anos"));

    for (var i = 0; i < atributos.length; i++)
        multiplicadoresEsforco[i] = document.querySelector('input[name = ' + atributos[i] + ']:checked').value;

    if (kdsi <= 50) {
        modoDesenvolvimento = "Orgânico/Convencional";
        esforcoBruto = estTempo * 3.2 * Math.pow(kdsi, 1.05);
        esforcoAjustado = esforcoBruto * calcularEsforcoAjustado(multiplicadoresEsforco);
        prazo = 2.5 * Math.pow(esforcoAjustado, 0.38);
    }
    else if (kdsi <= 300) {
        modoDesenvolvimento = "Difuso";
        esforcoBruto = estTempo * 3.0 * Math.pow(kdsi, 1.12);
        esforcoAjustado = esforcoBruto * calcularEsforcoAjustado(multiplicadoresEsforco);
        prazo = 2.5 * Math.pow(esforcoAjustado, 0.35);
    }
    else {
        modoDesenvolvimento = "Restrito";
        esforcoBruto = estTempo * 2.8 * Math.pow(kdsi, 1.20);
        esforcoAjustado = esforcoBruto * calcularEsforcoAjustado(multiplicadoresEsforco);
        prazo = 2.5 * Math.pow(esforcoAjustado, 0.32);
    }

    tamanhoEquipe = esforcoAjustado / prazo;

    document.getElementById("modoDesenvolvimento").value = modoDesenvolvimento;
    document.getElementById("esforcoBruto").value = esforcoBruto.toFixed(3);
    document.getElementById("esforcoAjustado").value = esforcoAjustado.toFixed(3);
    document.getElementById("prazo").value = prazo.toFixed(1) + " " + unidadeTempo;
    document.getElementById("tamanhoEquipe").value = Math.ceil(tamanhoEquipe) + " pessoa(s)";
}