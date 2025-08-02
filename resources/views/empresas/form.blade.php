<input type="text" name="cnpj" value="{{ old('cnpj', $empresa->cnpj ?? '') }}" placeholder="CNPJ" class="form-control mb-2" {{ isset($empresa) ? 'readonly' : '' }}>

<input type="text" name="razao_social" value="{{ old('razao_social', $empresa->razao_social ?? '') }}" placeholder="Razão Social" class="form-control mb-2" required>
<input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $empresa->nome_fantasia ?? '') }}" placeholder="Nome Fantasia" class="form-control mb-2" required>
<input type="text" name="telefone" value="{{ old('telefone', $empresa->telefone ?? '') }}" placeholder="Telefone" class="form-control mb-2" required>
<input type="text" name="inscricao_estadual" value="{{ old('inscricao_estadual', $empresa->inscricao_estadual ?? '') }}" placeholder="Inscrição Estadual" class="form-control mb-2" required>
<input type="date" name="data_abertura" value="{{ old('data_abertura', $empresa->data_abertura ?? '') }}" class="form-control mb-2" required>
<input type="text" name="porte" value="{{ old('porte', $empresa->porte ?? '') }}" placeholder="Porte" class="form-control mb-2" required>
<input type="email" name="email" value="{{ old('email', $empresa->email ?? '') }}" placeholder="Email" class="form-control mb-2" required>
<input type="text" name="regime_tributario" value="{{ old('regime_tributario', $empresa->regime_tributario ?? '') }}" placeholder="Regime Tributário" class="form-control mb-2" required>
<input type="text" name="cnae" value="{{ old('cnae', $empresa->cnae ?? '') }}" placeholder="CNAE" class="form-control mb-2" required>

<select name="optante_mei" class="form-control mb-2">
    <option value="1" {{ old('optante_mei', $empresa->optante_mei ?? '') == 1 ? 'selected' : '' }}>Sim</option>
    <option value="0" {{ old('optante_mei', $empresa->optante_mei ?? '') == 0 ? 'selected' : '' }}>Não</option>
</select>

<select name="status" class="form-control mb-2">
    <option value="1" {{ old('status', $empresa->status ?? '') == 1 ? 'selected' : '' }}>Ativa</option>
    <option value="0" {{ old('status', $empresa->status ?? '') == 0 ? 'selected' : '' }}>Inativa</option>
</select>

<hr>
<h4>Endereço</h4>

<input type="text" name="cep" value="{{ old('cep', $empresa->endereco->cep ?? '') }}" placeholder="CEP" class="form-control mb-2" required>
<input type="text" name="uf" value="{{ old('uf', $empresa->endereco->uf ?? '') }}" placeholder="UF" class="form-control mb-2" required>
<input type="text" name="cidade" value="{{ old('cidade', $empresa->endereco->cidade ?? '') }}" placeholder="Cidade" class="form-control mb-2" required>
<input type="text" name="bairro" value="{{ old('bairro', $empresa->endereco->bairro ?? '') }}" placeholder="Bairro" class="form-control mb-2" required>
<input type="text" name="numero" value="{{ old('numero', $empresa->endereco->numero ?? '') }}" placeholder="Número" class="form-control mb-2" required>
<input type="text" name="logradouro" value="{{ old('logradouro', $empresa->endereco->logradouro ?? '') }}" placeholder="Logradouro" class="form-control mb-2" required>
<input type="text" name="complemento" value="{{ old('complemento', $empresa->endereco->complemento ?? '') }}" placeholder="Complemento" class="form-control mb-2">
