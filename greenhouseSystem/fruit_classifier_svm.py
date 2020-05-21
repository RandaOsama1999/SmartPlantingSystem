import os
import warnings
import cv2
import numpy as np
import glob
from skimage.filters import threshold_yen
from skimage.exposure import rescale_intensity
from sklearn.preprocessing import StandardScaler
from sklearn import svm
from skimage.io import imread, imshow
from skimage.transform import resize
from skimage.feature import hog
from skimage import exposure
import matplotlib.pyplot as plt

def load_data(datasettype):
    arr = []
    strr = "Tomatoes/" + datasettype + "/*"
    for file in glob.glob(strr):
        img = cv2.imread(file)
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        resized_img = resize(img, (128, 64))
        fd = hog(resized_img, orientations=8, pixels_per_cell=(8, 8),
                            cells_per_block=(2, 2), multichannel=True)
        arr.append(fd)
    return arr

def run_svm(img):
    warnings.simplefilter(action='ignore', category=FutureWarning)
    warnings.simplefilter(action='ignore', category=DeprecationWarning)
    path = 'Tomatoes/Test'
    cv2.imwrite(os.path.join(path, 'test.jpg'), img)
    data_train = load_data('Train')
    data_test = load_data('Test')
    data_train = np.vstack(data_train)
    data_test = np.vstack(data_test)
    data_train = np.float32(data_train)
    data_test = np.float32(data_test)
    classes = ["Tomatoes"]
    oc_svm_clf = svm.OneClassSVM(gamma=0.001, kernel='rbf', nu=0.08)
    oc_svm_clf.fit(data_train)
    if_preds = oc_svm_clf.predict(data_test)
    correct = 0
    for x in if_preds:
        if x == 1:
            correct = correct + 1
    # print(if_preds)
    #print("The Accuracy is " + str((correct / if_preds.size) * 100))
    os.remove("Tomatoes/Test/test.jpg")
    return classes, if_preds
