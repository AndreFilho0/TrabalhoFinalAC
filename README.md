### TrabalhoFinalAC

- Fluxo de Integração: Formulário com ChatGPT API
- Diagrama do fluxo de dados entre o formulário e a API do ChatGPT para recomendação de processador:
```mermaid
flowchart TD
    A["Formulário de Entrada"] --> B["Dados do Usuário"]
    
    
    subgraph "Entrada de Dados"
        B --> D["Consumo de Energia"]
        B --> E["Desempenho"]
        B --> F["Custo"]
        B --> G["Tipo de Aplicação"]
    end
    
    D --> H["Processamento da Resposta API ChatGPT"]
    E --> H["Processamento da Resposta API ChatGPT"]
    F --> H["Processamento da Resposta API ChatGPT"]
    G --> H["Processamento da Resposta API ChatGPT"]    
    subgraph "Resposta do ChatGPT"
        H --> I["Tipo de Processador"]
        H --> J["Tipo de Arquitetura"]
        H --> K["Memória Cache"]
        H --> L["Frequência da CPU"]
        H --> M["Justificativa Técnica"]
    end
    
    I --> N["Exibição da Recomendação"]
    J --> N
    K --> N
    L --> N
    M --> N

%% Fluxo de dados do formulário para recomendação de processador
%% As entradas do usuário são processadas pela API do ChatGPT
%% A resposta é formatada e exibida com todas as especificações técnicas

```
- O diagrama mostra o fluxo completo desde a entrada de dados pelo usuário até a exibição da recomendação final, passando pelo processamento da API do ChatGPT.
