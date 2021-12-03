#!/usr/bin/env python3
# -*-coding: utf-8-*-
# @author: Jia Diru
# @email: diru_jia@berkeley.edu
# @date: 2021/11/30

import pandas as pd
import numpy as np
import sys
from sklearn.neighbors import NearestNeighbors


def get_cv(df):
    tmp = df.groupby('id').label.agg('unique').to_dict()
    df['pred_label'] = df['pred'].apply(lambda x: x[0].map(tmp))
    df['accuracy'] = df.apply(lambda x: x.label == x.pred_label, axis=1)
    return df.accuracy.mean()


def get_best_neighbors(df, embeddings, rank=5):
    nbrs = NearestNeighbors(n_neighbors=len(df), algorithm='ball_tree').fit(embeddings)
    distances, indices = nbrs.kneighbors(embeddings)

    posting_ids = np.array(df["id"].values.tolist())
    # distances = np.array(distances, dtype=np.float16)

    IDX = [i for i in range(1, rank+1)]
    ids = indices[len(df)-1, IDX]
    pred = posting_ids[ids]

    return pred


def run(path, id):
    """
    :param path: path of feature tables
    :param id: id of user test post
    :return: a list of id of recommended posts
    """
    feature = pd.read_pickle(path + "/df_for_model.pickle")

    embeddings_test = np.array(feature.loc[feature.id == id, 'features'].tolist())
    embeddings_train = np.array(feature.loc[feature.id != id, 'features'].tolist())

    embeddings = np.concatenate((embeddings_train, embeddings_test), axis=0)
    pred = get_best_neighbors(feature, embeddings, rank=4)

    return pred


if __name__ == '__main__':
    path = "."
    # id = '1k1xa4'
    id = sys.argv[1]
    print(run(path, id))
