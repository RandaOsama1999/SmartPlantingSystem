import os
from os import listdir
from PIL.ImagePath import Path
from fastai import *
from fastai.vision import *
import numpy as np
import seaborn as sns

def get_labels(file_path):
    dir_name = os.path.dirname(file_path)
    split_dir_name = dir_name.split("/")
    dir_levels = len(split_dir_name)
    label = split_dir_name[dir_levels - 1]
    return (label)
directory_root = '/PlantVillage/Train'
path = Path(directory_root)
image_list, label_list = [], []
if __name__ == '__main__':
    torch.multiprocessing.freeze_support()
    try:
        print("[INFO] Loading images ...")
        root_dir = listdir(directory_root)
        for directory in root_dir:
            # remove .DS_Store from list
            if directory == ".DS_Store":
                root_dir.remove(directory)

        for plant_folder in root_dir:
            plant_disease_folder_list = listdir(f"{directory_root}")

            for disease_folder in plant_disease_folder_list:
                # remove .DS_Store from list
                if disease_folder == ".DS_Store":
                    plant_disease_folder_list.remove(disease_folder)

            for plant_disease_folder in plant_disease_folder_list:
                print(f"[INFO] Processing {plant_disease_folder} ...")
                plant_disease_image_list = listdir(f"{directory_root}/{plant_disease_folder}/")

                for single_plant_disease_image in plant_disease_image_list:
                    if single_plant_disease_image == ".DS_Store":
                        plant_disease_image_list.remove(single_plant_disease_image)

                for image in plant_disease_image_list:
                    image_directory = f"{directory_root}/{plant_disease_folder}/{image}"
                    if image_directory.endswith(".jpg") == True or image_directory.endswith(".JPG") == True:
                        image_list.append(image_directory)
                        label_list.append(plant_disease_folder)
        print("[INFO] Image loading completed")
    except Exception as e:
        print(f"Error : {e}")
    data = ImageDataBunch.from_name_func(path, image_list, label_func=get_labels, size=256,
                                         bs=64, valid_pct=0.2)
    data.show_batch(rows=3, figsize=(8, 8))
    learn = cnn_learner(data, models.densenet121, metrics=[accuracy], model_dir='/tmp/models/')
    learn.lr_find()
    learn.recorder.plot()
    lr = 1e-1
    learn.fit_one_cycle(1, lr)
    learn.unfreeze()
    learn.lr_find()
    learn.recorder.plot()
    learn.save('/content/drive/My Drive/fastaimodelFinal')
    learn.load('/content/drive/My Drive/fastaimodelFinal')
    learn.recorder.plot_losses()
    conf= ClassificationInterpretation.from_learner(learn)
    conf.plot_confusion_matrix(figsize=(10,8))
    predictions,labels = learn.get_preds(ds_type=DatasetType.Valid)
    predictions = predictions.numpy()
    labels = labels.numpy()
    predicted_labels = np.argmax(predictions, axis = 1)
    print((predicted_labels == labels ).sum().item()/ len(predicted_labels))
