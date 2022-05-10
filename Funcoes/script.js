function sair(){
    res = confirm("Tem certeza que deseja sair ?");
    if(res){
        window.location = "Funcoes/sair.php";
    }
}

function excluir(codigo){
     res = confirm("Tem certeza que deseja excluir este prato ?");
    if(res){
        window.location = "Funcoes/excluir.php?codigo=" + codigo;
    }
}

function excluirBebida(codigo){
     res = confirm("Tem certeza que deseja excluir esta bebida ?");
    if(res){
        window.location = "Funcoes/excluirBebida.php?codigo=" + codigo;
    }
}

function excluirCombo(codigo){
     res = confirm("Tem certeza que deseja excluir este combo ?");
    if(res){
        window.location = "Funcoes/excluirCombo.php?codigo=" + codigo;
    }
}

function alterar(codigo){
    window.location = "admin.php?codigo=" + codigo;
}

function alterarBebida(codigo){
    window.location = "admin.php?codigo_bebida=" + codigo;
}

function alterarCombo(codigo){
    window.location = "admin.php?codigo_combo=" + codigo;
}

