package me.cristaling.webtest.utils;

import java.util.UUID;

public class UUIDUtils {

    public static UUID getUUIDFromString(String uuid) {
        if (uuid == null) {
            return null;
        }
        try {
            return UUID.fromString(uuid);
        } catch (IllegalArgumentException ex) {
            return null;
        }
    }

}
