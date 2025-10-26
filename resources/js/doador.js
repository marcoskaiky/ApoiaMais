// Alternar campos CPF/CNPJ para Doador
function alternarCamposDoador() {
    const tipo = document.querySelector('input[name="tipo_doador"]:checked').value;
    const campoCpf = document.getElementById('campo-cpf-doador');
    const campoCnpj = document.getElementById('campo-cnpj-doador');
    const inputCpf = document.getElementById('cpf_doador');
    const inputCnpj = document.getElementById('cnpj_doador');

    if (tipo === 'PF') {
        campoCpf.style.display = 'block';
        campoCnpj.style.display = 'none';
        inputCnpj.value = '';
        inputCnpj.removeAttribute('required');
        inputCpf.setAttribute('required', 'required');
    } else {
        campoCpf.style.display = 'none';
        campoCnpj.style.display = 'block';
        inputCpf.value = '';
        inputCpf.removeAttribute('required');
        inputCnpj.setAttribute('required', 'required');
    }
}

// Buscar CEP - Doadores
async function buscarCepDoador() {
    const cep = document.getElementById('cep_doador').value.replace(/\D/g, '');
    const loading = document.getElementById('loading_cep_doador');

    if (cep.length !== 8) {
        return;
    }

    loading.style.display = 'block';

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            alert('CEP não encontrado!');
            loading.style.display = 'none';
            return;
        }

        document.getElementById('rua_doador').value = data.logradouro || '';
        document.getElementById('bairro_doador').value = data.bairro || '';
        document.getElementById('cidade_doador').value = data.localidade || '';
        document.getElementById('uf_doador').value = data.uf || '';

        loading.style.display = 'none';
    } catch (error) {
        console.error('Erro ao buscar CEP:', error);
        alert('Erro ao buscar CEP. Tente novamente.');
        loading.style.display = 'none';
    }
}

// Buscar CEP - Instituições
async function buscarCepInstituicao() {
    const cep = document.getElementById('cep_instituicao').value.replace(/\D/g, '');
    const loading = document.getElementById('loading_cep_instituicao');

    if (cep.length !== 8) {
        return;
    }

    loading.style.display = 'block';

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            alert('CEP não encontrado!');
            loading.style.display = 'none';
            return;
        }

        document.getElementById('rua_instituicao').value = data.logradouro || '';
        document.getElementById('bairro_instituicao').value = data.bairro || '';
        document.getElementById('cidade_instituicao').value = data.localidade || '';
        document.getElementById('uf_instituicao').value = data.uf || '';

        loading.style.display = 'none';
    } catch (error) {
        console.error('Erro ao buscar CEP:', error);
        alert('Erro ao buscar CEP. Tente novamente.');
        loading.style.display = 'none';
    }
}

// Inicializar máscaras quando o documento carregar
document.addEventListener('DOMContentLoaded', function() {
    const cepDoador = document.getElementById('cep_doador');
    const cepInstituicao = document.getElementById('cep_instituicao');
    const cpfDoador = document.getElementById('cpf_doador');
    const cnpjDoador = document.getElementById('cnpj_doador');
    const cnpjInstituicao = document.querySelector('input[name="cnpj_instituicao"]');
    const telefoneDoador = document.querySelector('input[name="telefone_doador"]');
    const telefoneInstituicao = document.querySelector('input[name="telefone_instituicao"]');

    // Máscara CEP
    if (cepDoador) {
        cepDoador.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 8); // Limita a 8 dígitos
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });
    }

    if (cepInstituicao) {
        cepInstituicao.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 8); // Limita a 8 dígitos
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });
    }

    // Máscara CPF (000.000.000-00) - 11 dígitos
    if (cpfDoador) {
        cpfDoador.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 11); // Limita a 11 dígitos
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Máscara CNPJ (00.000.000/0000-00) - 14 dígitos
    if (cnpjDoador) {
        cnpjDoador.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 14); // Limita a 14 dígitos
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    if (cnpjInstituicao) {
        cnpjInstituicao.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 14); // Limita a 14 dígitos
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Máscara Telefone (00) 00000-0000 ou (00) 0000-0000 - 10 ou 11 dígitos
    if (telefoneDoador) {
        telefoneDoador.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 11); // Limita a 11 dígitos
            if (value.length <= 11) {
                if (value.length <= 10) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                } else {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                }
            }
            e.target.value = value;
        });
    }

    if (telefoneInstituicao) {
        telefoneInstituicao.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 11); // Limita a 11 dígitos
            if (value.length <= 11) {
                if (value.length <= 10) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                } else {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                }
            }
            e.target.value = value;
        });
    }
});

// Expor funções globalmente para serem chamadas pelos atributos onclick/onblur
window.alternarCamposDoador = alternarCamposDoador;
window.buscarCepDoador = buscarCepDoador;
window.buscarCepInstituicao = buscarCepInstituicao;
