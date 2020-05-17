import os
from os import listdir
from PIL.ImagePath import Path
from glob import glob
from fastai import *
from fastai.vision import *
import numpy as np
import pandas as pd
import seaborn as sns
import matplotlib.pyplot as plt
from sklearn.metrics import auc,roc_curve
from math import floor

directory_root = '/content/drive/My Drive/PlantDiseases/'
path = Path(directory_root)

if __name__ == '__main__':
    data_test = (ImageList.from_folder(path)
    .split_by_folder(train='Train', valid='Validation')
    .label_from_folder()
    .transform(size=256)
    .databunch(bs=64))
    data_test.show_batch(rows=3, figsize=(8,8))
    learner= cnn_learner(data_test, models.densenet121,metrics=[accuracy])
    learner.lr_find()
    learner.recorder.plot()
    lr=1e-1
    learner.fit_one_cycle(5, lr)
    learner.save('/content/drive/My Drive/modelTestdata1')
    learner.recorder.plot_losses()
    conf= ClassificationInterpretation.from_learner(learner)
    conf.plot_confusion_matrix(figsize=(10,8))
    predictions,labels = learner.get_preds(ds_type=DatasetType.Valid)

    predictions = predictions.numpy()
    labels = labels.numpy()

    predicted_labels = np.argmax(predictions, axis = 1)
    print((predicted_labels == labels ).sum().item()/ len(predicted_labels))
