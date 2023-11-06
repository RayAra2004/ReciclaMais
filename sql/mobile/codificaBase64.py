import base64

# Solicitar nome de usuário e senha ao usuário
username = input("Digite o nome de usuário: ")
password = input("Digite a senha: ")

# Concatenar o nome de usuário e a senha com os dois pontos
credentials = f"{username}:{password}"

# Codificar em Base64
encoded_credentials = base64.b64encode(credentials.encode()).decode()

# Imprimir o resultado
print(f"Sequência codificada em Base64: {encoded_credentials}")
