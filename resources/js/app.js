require('./bootstrap');

import IMask from 'imask';
window.IMask = IMask;

window.labels_pt_BR = {
    labelIdle: 'Arraste e solte os arquivos ou <span class="filepond--label-action"> Clique aqui </span>',
    labelInvalidField: 'Arquivos inválidos',
    labelFileWaitingForSize: 'Calculando o tamanho do arquivo',
    labelFileSizeNotAvailable: 'Tamanho do arquivo indisponível',
    labelFileLoading: 'Carregando',
    labelFileLoadError: 'Erro durante o carregamento',
    labelFileProcessing: 'Enviando',
    labelFileProcessingComplete: 'Envio finalizado',
    labelFileProcessingAborted: 'Envio cancelado',
    labelFileProcessingError: 'Erro durante o envio',
    labelFileProcessingRevertError: 'Erro ao reverter o envio',
    labelFileRemoveError: 'Erro ao remover o arquivo',
    labelTapToCancel: 'clique para cancelar',
    labelTapToRetry: 'clique para reenviar',
    labelTapToUndo: 'clique para desfazer',
    labelButtonRemoveItem: 'Remover',
    labelButtonAbortItemLoad: 'Abortar',
    labelButtonRetryItemLoad: 'Reenviar',
    labelButtonAbortItemProcessing: 'Cancelar',
    labelButtonUndoItemProcessing: 'Desfazer',
    labelButtonRetryItemProcessing: 'Reenviar',
    labelButtonProcessItem: 'Enviar',
    labelMaxFileSizeExceeded: 'Arquivo é muito grande',
    labelMaxFileSize: 'O tamanho máximo permitido: {filesize}',
    labelMaxTotalFileSizeExceeded: 'Tamanho total dos arquivos excedido',
    labelMaxTotalFileSize: 'Tamanho total permitido: {filesize}',
    labelFileTypeNotAllowed: 'Tipo de arquivo inválido',
    fileValidateTypeLabelExpectedTypes: 'Tipos de arquivo suportados são {allButLastType} ou {lastType}',
    imageValidateSizeLabelFormatError: 'Tipo de imagem inválida',
    imageValidateSizeLabelImageSizeTooSmall: 'Imagem muito pequena',
    imageValidateSizeLabelImageSizeTooBig: 'Imagem muito grande',
    imageValidateSizeLabelExpectedMinSize: 'Tamanho mínimo permitida: {minWidth} × {minHeight}',
    imageValidateSizeLabelExpectedMaxSize: 'Tamanho máximo permitido: {maxWidth} × {maxHeight}',
    imageValidateSizeLabelImageResolutionTooLow: 'Resolução muito baixa',
    imageValidateSizeLabelImageResolutionTooHigh: 'Resolução muito alta',
    imageValidateSizeLabelExpectedMinResolution: 'Resolução mínima permitida: {minResolution}',
    imageValidateSizeLabelExpectedMaxResolution: 'Resolução máxima permitida: {maxResolution}',
    credits: false
};

if (typeof FilePond === "object") {
    FilePond.setOptions(labels_pt_BR);
}