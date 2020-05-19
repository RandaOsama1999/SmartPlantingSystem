import os
import warnings
import cv2
import numpy as np
import glob
from skimage.filters import threshold_yen
from skimage.exposure import rescale_intensity
from sklearn.preprocessing import StandardScaler
from sklearn import svm


def hog(img, B):
    r = img[:, :, 0]
    g = img[:, :, 1]
    b = img[:, :, 2]
    r = hog2(r, B)
    g = hog2(g, B)
    b = hog2(b, B)
    hist = np.concatenate((r, g, b))
    return hist

def hog2(img, B):
    c = img.shape[0] // 2
    f = img.shape[1] // 2
    gx = cv2.Sobel(img, cv2.CV_32F, 1, 0)
    gy = cv2.Sobel(img, cv2.CV_32F, 0, 1)
    mag, ang = cv2.cartToPolar(gx, gy)
    bins = np.int32((ang * B) / (2 * np.pi))
    bin_cells = bins[:c, :c], bins[f:, :c], bins[:c, f:], bins[f:, f:]
    mag_cells = mag[:c, :c], mag[f:, :c], mag[:c, f:], mag[f:, f:]
    hists = [np.bincount(b.ravel(), m.ravel(), B) for b, m in zip(bin_cells, mag_cells)]
    hist = np.hstack(hists)
    return hist

def load_data(datasettype):
    arr = []
    strr = "Tomatoes/" + datasettype + "/*"
    for file in glob.glob(strr):
        img = cv2.imread(file)
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        yen_threshold = threshold_yen(img)
        bright = rescale_intensity(img, (0, yen_threshold), (0, 255))
        h = hog(bright, 16)
        arr.append(h)
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

    ss = StandardScaler()
    ss.fit(data_train)
    X_train = ss.transform(data_train)
    X_test = ss.transform(data_test)
    oc_svm_clf = svm.OneClassSVM(gamma=0.001, kernel='rbf', nu=0.08)
    oc_svm_clf.fit(X_train)
    if_preds = oc_svm_clf.predict(X_test)
    correct = 0
    for x in if_preds:
        if x == 1:
            correct = correct + 1
    # print(if_preds)
    #print("The Accuracy is " + str((correct / if_preds.size) * 100))
    os.remove("Tomatoes/Test/test.jpg")
    return classes, if_preds


